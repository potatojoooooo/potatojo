<!DOCTYPE html>
<html>

<head>
  <title>Gmail API Quickstart</title>
  <meta charset="utf-8" />
</head>

<body>
  <p>Gmail API Quickstart</p>

  <!--Add buttons to initiate auth sequence and sign out-->
  <button id="authorize_button" onclick="handleAuthClick()">Authorize</button>
  <button id="signout_button" onclick="handleSignoutClick()">Sign Out</button>

  <div id="total">
    Total messages:
  </div>
  <table class="table table-striped table-inbox hidden">
    <thead>
      <tr>
        <th>From</th>
        <th>Subject</th>
        <th>Date/Time</th>
      </tr>
    </thead>
    <tbody id="result">

    </tbody>
  </table>
  </div>
  <pre id="content" style="white-space: pre-wrap;"></pre>

  <script type="text/javascript">
    /* exported gapiLoaded */
    /* exported gisLoaded */
    /* exported handleAuthClick */
    /* exported handleSignoutClick */
    let accessToken;
    // TODO(developer): Set to client ID and API key from the Developer Console
    const CLIENT_ID = '663213126994-j3egh5u90djpebpta0h104ckrhqbeveg.apps.googleusercontent.com';
    const API_KEY = 'AIzaSyACqi-a5Hr_6Wcf2UhrVAhYqPTwYD2hTvM';


    // Discovery doc URL for APIs used by the quickstart
    const DISCOVERY_DOC = 'https://www.googleapis.com/discovery/v1/apis/gmail/v1/rest';

    // Authorization scopes required by the API; multiple scopes can be
    // included, separated by spaces.
    const SCOPES = 'https://www.googleapis.com/auth/gmail.readonly';

    let tokenClient;
    let gapiInited = false;
    let gisInited = false;

    let messageData = {}

    let total = document.getElementById('total')
    let divResult = document.getElementById('result')
    let number = 10


    /**
     * Callback after api.js is loaded.
     */
    function gapiLoaded() {
      gapi.load('client', initializeGapiClient);

    }

    /**
     * Fetches and logs the user's Gmail messages.
     */



    document.getElementById('authorize_button').style.visibility = 'hidden';
    document.getElementById('signout_button').style.visibility = 'hidden';



    /**
     * Callback after the API client is loaded. Loads the
     * discovery doc to initialize the API.
     */
    async function initializeGapiClient() {
      await gapi.client.init({
        apiKey: API_KEY,
        discoveryDocs: [DISCOVERY_DOC],
      });
      gapiInited = true;
      maybeEnableButtons();
    }


    /**
     * Callback after Google Identity Services are loaded.
     */
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

    /**
     * Enables user interaction after all libraries are loaded.
     */
    function maybeEnableButtons() {
      if (gapiInited && gisInited) {
        document.getElementById('authorize_button').style.visibility = 'visible';
      }
    }

    /**
     *  Sign in the user upon button click.
     */
    async function handleAuthClick() {
      tokenClient.callback = async (resp) => {
        if (resp.error !== undefined) {
          throw (resp);
        }
        accessToken = resp.access_token; // Store the access token
        document.getElementById('signout_button').style.visibility = 'visible';
        document.getElementById('authorize_button').innerText = 'Refresh';
        await listLabels();
        getMessages();
      };

      if (gapi.client.getToken() === null) {
        // Prompt the user to select a Google Account and ask for consent to share their data
        // when establishing a new session.
        tokenClient.requestAccessToken({
          prompt: 'consent'
        });
      } else {
        // Skip display of account chooser and consent dialog for an existing session.
        tokenClient.requestAccessToken({
          prompt: ''
        });
      }
    }

    /**
     *  Sign out the user upon button click.
     */
    function handleSignoutClick() {
      const token = gapi.client.getToken();
      if (token !== null) {
        google.accounts.oauth2.revoke(token.access_token);
        gapi.client.setToken('');
        document.getElementById('content').innerText = '';
        document.getElementById('authorize_button').innerText = 'Authorize';
        document.getElementById('signout_button').style.visibility = 'hidden';
      }
    }

    /**
     * Print all Labels in the authorized user's inbox. If no labels
     * are found an appropriate message is printed.
     */
    async function listLabels() {
      let response;
      try {
        response = await gapi.client.gmail.users.labels.list({
          'userId': 'me',
        });
      } catch (err) {
        document.getElementById('content').innerText = err.message;
        return;
      }
      const labels = response.result.labels;
      if (!labels || labels.length == 0) {
        document.getElementById('content').innerText = 'No labels found.';
        return;
      }
      // Flatten to string to display
      const output = labels.reduce(
        (str, label) => `${str}${label.name}\n`,
        'Labels:\n');
      document.getElementById('content').innerText = output;

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
              })
          })
        })
    }
  </script>
  <script async defer src="https://apis.google.com/js/api.js" onload="gapiLoaded()"></script>
  <script async defer src="https://accounts.google.com/gsi/client" onload="gisLoaded()"></script>
</body>

</html>