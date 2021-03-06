        var d = new Date(); // now
        var d2 = new Date(2020, 1, 1, 0, 0, 0, 0); // year, month, day, hours, minutes, seconds
        var d3 = new Date(2020, 1, 1, 0, 0, 0);
        var d4 = new Date(2020, 1, 1);
        var d5 = new Date(0); // milliseconds
        var d6 = new Date("2020-01-01T00:00:00");
        
        console.log('unix zero time', new Date(0).toString());
        
        console.log('toString', d.toString()); // "Wed Jan 01 2020 00:00:00 GMT+0100 (Central European Standard Time)"  
        console.log('toTimeString', d.toTimeString()); // 23:37:10 GMT+0100 (Central European Standard Time)
        
           
        console.log('toUTCString', d.toUTCString()); // Fri, 20 Dec 2019 20:52:09 GMT
        console.log('toGMTString', d.toGMTString()); // Fri, 20 Dec 2019 20:52:09 GMT
        console.log('toISOString', d.toISOString()); // 2019-12-20T20:58:03.427Z
        console.log('toJSON', d.toJSON()); // 2019-12-20T20:59:35.351Z
        console.log('toLocaleDateString', 
            d.toLocaleDateString(
                'sk-SK', 
                {
                    dateStyle : 'full', // full long medium short
                    timeStyle : 'full', // full long medium short
                    localeMatcher: "lookup", // "best fit"
                    timeZone: 'Europe/Bratislava',
                    hour12:true, 
                    hourCycle: 'h24' , // h11, h12, h23, or h24
                    formatMatcher: 'best fit', // basic
                    weekday: 'long', 
                    era: 'long', // "long" "short" "narrow" 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric', 
                    hour: 'numeric', //"numeric", "2-digit".
                    minute: 'numeric', //"numeric", "2-digit",
                    second:'numeric', //"numeric", "2-digit".
                    timeZoneName: 'long', // short
                }
            )
        ); // piatok 20. decembra 2019, 11:32:59 PM stredoeurópsky štandardný čas
        
        console.log('toLocaleString', 
            d.toLocaleDateString(
                'sk-SK', 
                {
                    dateStyle : 'full', // full long medium short
                    timeStyle : 'full', // full long medium short
                    localeMatcher: "lookup", // "best fit"
                    timeZone: 'Europe/Bratislava',
                    hour12:true, 
                    hourCycle: 'h24' , // h11, h12, h23, or h24
                    formatMatcher: 'best fit', // basic
                    weekday: 'long', 
                    era: 'long', // "long" "short" "narrow" 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric', 
                    hour: 'numeric', //"numeric", "2-digit".
                    minute: 'numeric', //"numeric", "2-digit",
                    second:'numeric', //"numeric", "2-digit".
                    timeZoneName: 'long', // short
                }
            )
        ); 
        
        console.log('toLocaleTimeString', 
            d.toLocaleDateString(
                'sk-SK', 
                {
                    dateStyle : 'full', // full long medium short
                    timeStyle : 'full', // full long medium short
                    localeMatcher: "lookup", // "best fit"
                    timeZone: 'Europe/Bratislava',
                    hour12:true, 
                    hourCycle: 'h24' , // h11, h12, h23, or h24
                    formatMatcher: 'best fit', // basic
                    weekday: 'long', 
                    era: 'long', // "long" "short" "narrow" 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric', 
                    hour: 'numeric', //"numeric", "2-digit".
                    minute: 'numeric', //"numeric", "2-digit",
                    second:'numeric', //"numeric", "2-digit".
                    timeZoneName: 'long', // short
                }
            )
        ); 

        console.log('getTimezoneOffset', d.getTimezoneOffset()); // in minutes -60
        
        console.log('getUTCDate', d.getUTCDate());
        console.log('getUTCDay', d.getUTCDay());
        console.log('getUTCFullYear', d.getUTCFullYear());
        console.log('getUTCHours', d.getUTCHours());
        console.log('getUTCMilliseconds', d.getUTCMilliseconds());
        console.log('getUTCMinutes', d.getUTCMinutes());
        console.log('getUTCMonth', d.getUTCMonth());
        console.log('getUTCSeconds', d.getUTCSeconds());
        
        var d = new Date();
        d.setUTCFullYear(2020);
        d.setUTCMonth(0);
        d.setUTCDate(1);
        
        d.setUTCHours(0);
        d.setUTCMinutes(0);
        d.setUTCSeconds(0);
        d.setUTCMilliseconds(0);
        
        console.log('toDateString', d.toDateString()); // Fri Dec 20 2019
        console.log('getFullYear', d.getFullYear()); // yyyy
        console.log('getFullYear', d.getYear()); // yy
        console.log('getMonth', d.getMonth()); // 0-11
        console.log('getDate', d.getDate()); // 1-31
        console.log('getDay', d.getDay()); // 0-6
        
        console.log('getHours', d.getHours()); // 0-23
        console.log('getMinutes', d.getMinutes()); // 0-59
        console.log('getSeconds', d.getSeconds()); // 0-59
        console.log('getMilliseconds', d.getMilliseconds()); // 0-999
        
        console.log('getTime', d.getTime()); // unix time

        console.log('now', Date.now());
        console.log('parse', Date.parse(" Tue, 31 Dec 2019 23:00:00 GMT"));
        
        var d = new Date();
        d.setFullYear(2020);
        d.setMonth(0);
        d.setDate(1);
        
        d.setHours(0);
        d.setMinutes(0);
        d.setSeconds(0);
        d.setMilliseconds(0);
            
        d.setTime(1576873104549); // set unix time
