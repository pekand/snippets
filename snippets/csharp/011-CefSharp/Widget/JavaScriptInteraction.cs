using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Widget
{
    public class JavaScriptInteraction
    {
        public void ShowMessage(string message)
        {
            MessageBox.Show($"Message from JavaScript: {message}");
        }
    }
}
