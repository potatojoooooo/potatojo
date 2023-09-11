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

    const SCOPES = 'https://www.googleapis.com/auth/gmail.readonly';

    let tokenClient;
    let gapiInited = false;
    let gisInited = false;

    let messageData = {}

    let total = document.getElementById('total')
    let divResult = document.getElementById('result')




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

    function getMessages() {
      fetch("https://gmail.googleapis.com/gmail/v1/users/me/messages", {
          method: 'GET',
          headers: new Headers({
            Authorization: `Bearer ${accessToken}`
          })
        })
        .then((data) => data.json())
        .then((info) => {
          console.log(info);

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
                  if (message.name == "Date" || message.name == "Subject" || message.name == "From") {
                    result.push(message.value);
                  }
                });

                // Add 'snippet' to the 'result' array
                result.push(snippet);

                // Display the result in the table row
                divResult.innerHTML += `
              <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700 event-row">
                <td class="px-6 py-4">${result[0]}</td>
                <td class="px-6 py-4">${result[1]}</td>
                <td class="px-6 py-4">${result[2]}</td>
                <td class="px-6 py-4">${result[3]}</td>
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