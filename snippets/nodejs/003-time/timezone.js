const time = new Date(Date.UTC(2021, 1, 1, 0, 0, 0));
console.log("default  : "+time);
console.log("toString : "+time.toString());
console.log("toJSON   : "+time.toJSON());
console.log("utc      : "+time.toUTCString());
console.log("iso      : "+time.toISOString());
console.log("iso      : "+time.toJSON());
console.log("en-GB    : "+time.toLocaleString('en-GB', { timeZone: 'UTC' }));
console.log("en-US    : "+time.toLocaleString('en-US', { timeZone: 'UTC' }));
console.log("sk-SK    : "+time.toLocaleString('sk-SK', { timeZone: 'Europe/Bratislava' }));
console.log("parse    : "+ Date.parse('01 Jan 1970 00:00:00 GMT'));
console.log("parse2   : "+ new Date(Date.parse('2021-12-17T22:58:00.000+02:00')).toISOString());
console.log("offset2  : "+(new Date().getTimezoneOffset()));
console.log("unixtime : "+time.getTime());
console.log("UTC      : "+Date.UTC(2021, 1, 1, 0, 0, 0));


