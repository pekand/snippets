/*
    minimsal example
*/


fetch('https://snippets.loc/assets/json/data.json')
  .then(response => response.json())
  .then(data => console.log(data));


/*

    fetch parameters

    method: *GET, POST, PUT, DELETE
    mode: no-cors, *cors, same-origin
    cache: *default, no-cache, reload, force-cache, only-if-cached
    credentials: include, *same-origin, omit
    headers: {
      'Content-Type': 'application/json'
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    redirect: manual, *follow, error
    referrerPolicy: no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url


    no-cors allowed headers {
        Accept
        Accept-Language
        Content-Language
        Content-Type: application/x-www-form-urlencoded 
        Content-Type: multipart/form-data
        Content-Type: text/plain
    }
*/

async function postData(method='POST', url = '', data = {}) {
  const response = await fetch(url, {
    method: 'POST', 
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  });
  return response.json();
}

postData('POST', 'https://snippets.loc/assets/json/data.json', {a:1,b:2}).then(data => console.log(data));
