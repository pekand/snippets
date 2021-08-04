using System;
using System.ComponentModel;
using System.Drawing;
using System.Windows.Forms;

namespace WinFormsControlLibrary1
{
    

    public partial class UserControl1 : UserControl
    {
        private string customParameter = "";

        [
           Category("Category name"),
           Description("description")
        ]
 
        public string CustomParameter
        {
            get
            {
                return customParameter;
            }
            set
            {
                customParameter = value;
                Invalidate();
            }
        }

        [Browsable(true)]
        [Category("Action")]
        [Description("Invoked when user clicks button")]
        public event EventHandler ButtonClick;

        protected void Button1_Click(object sender, EventArgs e)
        {
            MessageBox.Show("text");

            if (this.ButtonClick != null)
                this.ButtonClick(this, e);
        }

        protected override void OnClick(EventArgs e)
        {
            this.Button1_Click(this, e);
        }


        public UserControl1()
        {
            InitializeComponent();
            SetStyle(ControlStyles.ResizeRedraw, true);
        }

        private void UserControl1_Load(object sender, EventArgs e)
        {

        }

        private void UserControl1_Paint(object sender, PaintEventArgs e)
        {

        }

        protected override void OnPaintBackground(PaintEventArgs pevent)
        {
            base.OnPaintBackground(pevent);

            pevent.Graphics.DrawString("Text",
                new Font("Comic Sans MS", 32), Brushes.Black, new PointF(0, 0));

        }

        protected override void OnPaint(PaintEventArgs e)
        {
            Graphics g = e.Graphics;

            Pen invalidPen = new Pen(Color.Red, 2);
            g.DrawRectangle(invalidPen, 0, 0, this.Width, this.Height);
        }


        public void customRefresh()
        {
            this.Refresh();
        }
    }
}
