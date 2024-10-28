using CefSharp.WinForms;
using CefSharp;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Security.Cryptography.X509Certificates;
using CefSharp.Structs;
using CefSharp.Enums;
using System.Net.Http;

namespace Widget
{
    public partial class FormWidget : Form
    {
        private ChromiumWebBrowser browser;

        public void InjectJavascript(string js) {
            try
            {
                browser.ExecuteScriptAsync(js);
            }
            catch
            {
                EventHandler<LoadingStateChangedEventArgs> handler = null;
                handler = (senderer, args) =>
                {
                    if (!args.IsLoading)
                    {
                        browser.ExecuteScriptAsync(js);
                        browser.LoadingStateChanged -= handler;
                    }
                };
                browser.LoadingStateChanged += handler;
            }
        }

        public void LoadHtml(string html)
        {
            try
            {
                browser.LoadHtml(html, "http://customdomain/");
            }
            catch
            {
                EventHandler<LoadingStateChangedEventArgs> handler = null;
                handler = (senderer, args) =>
                {
                    if (!args.IsLoading)
                    {
                        browser.LoadHtml(html, "http://customdomain/");
                        browser.LoadingStateChanged -= handler;
                    }
                };
                browser.LoadingStateChanged += handler;
            }
        }

        public FormWidget()
        {
            InitializeComponent();

            browser = new ChromiumWebBrowser();
            this.Controls.Add(browser);
            browser.Dock = DockStyle.Fill;

            var jsInteraction = new JavaScriptInteraction();
            browser.JavascriptObjectRepository.Settings.LegacyBindingEnabled = true;
            browser.JavascriptObjectRepository.Register("jsBridge", jsInteraction, isAsync: false);
            browser.RequestHandler = new CustomRequestHandler();
            browser.DisplayHandler = new CustomDisplayHandler();
        }

        private void FormWidget_Load(object sender, EventArgs e)
        {
            

            string htmlContent = @"
    <html>
        <head>
            <title>Custom Page</title>
        </head>
        <body>
            <h1>Hello from CefSharp!</h1>
            <button onclick='sendConsoleMessage()'>Click Me</button>
            <script>
                function sendConsoleMessage() {
                    console.log('This is a test message from JavaScript.');
dsfgsdfgdfg;
                }
            </script>

            <button onclick=""jsBridge.showMessage('Hello from JavaScript!')"">Call C#</button>

        </body>
    </html>";

            this.LoadHtml(htmlContent);
            this.InjectJavascript("document.body.style.backgroundColor = 'lightblue';");
        }
    }
}
