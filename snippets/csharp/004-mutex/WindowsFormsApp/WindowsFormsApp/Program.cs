using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WindowsFormsApp
{
    static class Program
    {
        [STAThread]
        static void Main()
        {
            /*************************************/

            bool createdNew = false;
            using (Mutex mutex = new Mutex(true, "APPLICATION_NAME", out createdNew))
            {
                if (createdNew)
                {
                    Application.EnableVisualStyles();
                    Application.SetCompatibleTextRenderingDefault(false);
                    Application.Run(new Form1());
                }
                else
                {
                    MessageBox.Show("Another instance already running!");
                }
            }

            /*************************************/

           
        }
    }
}
