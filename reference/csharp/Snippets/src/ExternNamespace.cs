using System;
using System.Runtime.InteropServices;

namespace Snippets.ExternNamespace
{
    class App
    {
        [DllImport("User32.dll", CharSet = CharSet.Unicode)]
        public static extern int MessageBox(IntPtr h, string m, string c, int type);

        public static void Run()
        {
            Console.WriteLine("-Extern");

            string message = "Message1";
            
            // MessageBox((IntPtr)0, message, "Message Box", 0); // show alert

            Console.WriteLine(message);
        }
    }
}
