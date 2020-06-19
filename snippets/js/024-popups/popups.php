<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="Description" content="description here.">
        <title>Page</title>
        <link rel="shortcut icon" href="favicon.ico" />

        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>

    </head>
    <body>
        <main>
            <button onclick="openPopup1()">Open popup 1</button>
            <button onclick="closePopup1()">Close popup 1</button>
            <button onclick="changePopup1()">change popup 1</button>
            <button onclick="focusPopup1()">focus popup 1</button>
            <button onclick="scrollPopup1()">scroll popup 1</button><br>
            <button onclick="openPopup2()">Open popup 2</button><br>
            <button onclick="openPopup3()">Open popup 3</button><br>
            <button onclick="openPopup4()">Open popup 4</button><br>
        </main>
<br><br>
        <div id="info">
            
        </div>
        <script type="text/javascript">
            var popupWindow1 = null;
            var popupWindow2 = null;
            var popupWindow3 = null;
            var popupWindow4 = null;

            /*
                open popup
            */
            function openPopup1(){
                let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=-1000,top=-1000`;

                popupWindow1 = window.open('popupWindow1.php', 'popup1', params );
            }

            /*
                close popup
            */
            function closePopup1(){
                let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=-1000,top=-1000`;

                popupWindow1.close();
            }

            /*
                change popup parameters
            */
            function changePopup1(){
                popupWindow1.moveTo(100,100);
                popupWindow1.moveBy(100,100);
                popupWindow1.resizeTo(500,500);
                popupWindow1.resizeBy(100,100);
            }

            /*
                focus popup window 
            */
            function focusPopup1(){
                popupWindow1.onblur = function () {
                    console.log("popup blur");
                }

                popupWindow1.focus(100,100);
            }

            /*
                scroll popup window 
            */
            function scrollPopup1(){
                popupWindow1.onscroll = function () {
                    console.log("scroll in popup");
                }

                popupWindow1.scrollTo(0,100);
                popupWindow1.scrollBy(0,100);
                
                popupWindow1.document.getElementById('element').scrollIntoView();
            }

            /*
                change popup content
            */
            function openPopup2(){
                let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=-1000,top=-1000`;

                popupWindow2 = window.open('about:blank', 'popup2', params );

                popupWindow2.document.write("Hello, world!");
            }

            /*
                change popup content after load
            */
            function openPopup3(){
                let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=-1000,top=-1000`;

                popupWindow3 = window.open('about:blank', 'popup3', params );

                popupWindow3.onload = function() {
                  var html = '<div style="font-size:30px">Welcome!</div>';
                  popupWindow3.document.body.insertAdjacentHTML('afterbegin', html);
                };
            }

            /*
                change perent from popup window
            */
            function openPopup4(){
                let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=-1000,top=-1000`;

                popupWindow4 = window.open('popupWindow2.php', 'popup3', params );
            }
        </script>
    </body>
</html>
