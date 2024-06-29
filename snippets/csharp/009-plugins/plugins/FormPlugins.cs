namespace XmlConfig
{
    public partial class FormPlugins : Form
    {
        Log log = null;
        Config config = null;
        ConfigFile configFile = null;

        public FormPlugins()
        {
            Config config = new Config();
            this.log = new Log(config);
            this.configFile = new ConfigFile(config, this.log);

            InitializeComponent();
        }

        private void FormPlugins_Load(object sender, EventArgs e)
        {
            
        }

        private void buttonSave_Click(object sender, EventArgs e)
        {
            configFile.Save();
        }

        private void buttonLoad_Click(object sender, EventArgs e)
        {
            configFile.Load();
        }
    }
}
