<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Emails') }}
      </h2>
      <x-primary-button class="text-center ml-3" id="authorize_button" onclick="handleAuthClick()">Authorize
      </x-primary-button>
    </div>

  </x-slot>

  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class="mb-4 w-80">
      <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
      <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <svg class="text-white w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
          </svg>
        </div>
        <input type="search" name="search" id="search" class="block w-full pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 form-control" placeholder="Annoucements, Events, Training...">
        <button id="searchBtn" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
      </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3 text-gray-900 dark:text-gray-100">
              From
            </th>
            <th scope="col" class="px-6 py-3 text-gray-900 dark:text-gray-100 text-ellipsis">
              Date
            </th>
            <th scope="col" class="px-6 py-3 text-gray-900 dark:text-gray-100 text-ellipsis">
              Subject
            </th>
            <th scope="col" class="px-6 py-3 text-gray-900 dark:text-gray-100 text-ellipsis">
              Email Snippet
            </th>
            <th scope="col" class="px-6 py-3 text-gray-900 dark:text-gray-100 text-ellipsis">
              Actions
            </th>
          </tr>
        </thead>
        <tbody id="result">

        </tbody>
      </table>
    </div>
  </div>

  <pre id="content" style="white-space: pre-wrap;"></pre>

  <script type="text/javascript">
    let accessToken;

    const CLIENT_ID = '663213126994-j3egh5u90djpebpta0h104ckrhqbeveg.apps.googleusercontent.com';
    const API_KEY = 'AIzaSyACqi-a5Hr_6Wcf2UhrVAhYqPTwYD2hTvM';

    const DISCOVERY_DOC = 'https://www.googleapis.com/discovery/v1/apis/gmail/v1/rest';

    const SCOPES = 'https://www.googleapis.com/auth/gmail.readonly https://www.googleapis.com/auth/gmail.modify';

    let tokenClient;
    let gapiInited = false;
    let gisInited = false;

    let messageData = {}

    let total = document.getElementById('total')
    let divResult = document.getElementById('result')

    let q = ""
    let searchBtn = document.getElementById('searchBtn')
    let search = document.getElementById('search')


    function gapiLoaded() {
      gapi.load('client', initializeGapiClient);

    }

    document.getElementById('authorize_button').style.visibility = 'hidden';

    async function initializeGapiClient() {
      await gapi.client.init({
        apiKey: API_KEY,
        discoveryDocs: [DISCOVERY_DOC],
      });
      gapiInited = true;
      maybeEnableButtons();
    }

    function gisLoaded() {
      tokenClient = google.accounts.oauth2.initTokenClient({
        client_id: CLIENT_ID,
        scope: SCOPES,
        callback: (tokenResponse) => {
          console.log(tokenResponse);
        } // defined later
      });

      console.log(tokenClient);
      gisInited = true;
      maybeEnableButtons();
    }

    function maybeEnableButtons() {
      if (gapiInited && gisInited) {
        document.getElementById('authorize_button').style.visibility = 'visible';
      }
    }

    async function handleAuthClick() {
      tokenClient.callback = async (resp) => {
        if (resp.error !== undefined) {
          throw (resp);
        }
        accessToken = resp.access_token; // Store the access token
        document.getElementById('authorize_button').innerText = 'Refresh';
        getMessages();
      };

      if (gapi.client.getToken() === null) {
        tokenClient.requestAccessToken({
          prompt: 'consent'
        });
      } else {
        tokenClient.requestAccessToken({
          prompt: ''
        });
      }
    }

    searchBtn.onclick = () => {
      divResult.innerHTML = "";
      getMessages(search.value)
    }

    function getMessages(q = "") {

      let url = ""

      if (q == "") {
        url = "https://gmail.googleapis.com/gmail/v1/users/me/messages"
      } else {
        url = `https://gmail.googleapis.com/gmail/v1/users/me/messages?q=${q}`
      }

      fetch(url, {
          method: 'GET',
          headers: new Headers({
            Authorization: `Bearer ${accessToken}`
          })
        })
        .then((data) => data.json())
        .then((info) => {
          console.log(info);

          info.messages.sort((a, b) => {
            const dateA = new Date(a.internalDate);
            const dateB = new Date(b.internalDate);
            return dateB - dateA;
          });

          Array.from(info.messages).forEach((message) => {
            fetch(`https://gmail.googleapis.com/gmail/v1/users/me/messages/${message.id}`, {
                method: 'GET',
                headers: new Headers({
                  Authorization: `Bearer ${accessToken}`
                })
              })
              .then((data) => data.json())
              .then((info) => {
                console.log(info);

                // Extract the 'snippet' from the 'info' object
                const snippet = info.snippet;

                messageData = {
                  id: info.id,
                  msg: snippet // Add 'snippet' to the 'messageData' object
                };

                let result = [];

                console.log(message);

                Array.from(info.payload.headers).forEach((message) => {
                  if (message.name == "From") {
                    result[0] = message.value; // Push to the first position (index 0)
                  } else if (message.name == "Date") {
                    result[1] = message.value; // Push to the second position (index 1)
                  } else if (message.name == "Subject") {
                    result[2] = message.value; // Push to the third position (index 2)
                  }
                });

                // Add 'snippet' to the 'result' array
                result.push(snippet);

                // Display the result in the table row
                divResult.innerHTML += `
              <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700 event-row" id='${messageData.id}'>
                <td class="px-6 py-4">${result[0]}</td>
                <td class="px-6 py-4">${result[1]}</td>
                <td class="px-6 py-4">${result[2]}</td>
                <td class="px-6 py-4"><a target="_blank" href="https://mail.google.com/mail/u/0/#inbox/${messageData.id}">${result[3]}</td>
                <td class="px-6 py-4"><button onclick="
                  fetch('https://gmail.googleapis.com/gmail/v1/users/me/messages/${messageData.id}/trash', {
                    method: 'POST',
                    headers: new Headers({Authorization: 'Bearer ${accessToken}'})
                  })
                  .then((info) => {
                    console.log(info)
                    document.getElementById('${messageData.id}').remove()
                  })
                  " 
                
                  class = 'inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'>Trash</button></td>
                
              </tr>
            `;
              });
          });
        });
    }
  </script>
  <script async defer src="https://apis.google.com/js/api.js" onload="gapiLoaded()"></script>
  <script async defer src="https://accounts.google.com/gsi/client" onload="gisLoaded()"></script>
</x-app-layout>