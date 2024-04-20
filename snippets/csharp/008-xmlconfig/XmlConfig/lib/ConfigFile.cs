using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Xml.Linq;
using System.Xml;
using Microsoft.VisualBasic.Logging;
using System.Reflection;

namespace XmlConfig
{
    public class ConfigFile
    {
        Config config = null;
        Log log = null;

        public ConfigFile(Config config, Log log) { 
            this.config = config;
            this.log = log;
            this.SetupRoamingConfigDirectory();
        }

        public void SetupRoamingConfigDirectory()
        {
            string confidDirectory = Environment.GetFolderPath(Environment.SpecialFolder.ApplicationData);
 
            string appRoamingDirectory = Path.Combine(confidDirectory, this.config.appName);

            if (!Directory.Exists(appRoamingDirectory))
            {
                Directory.CreateDirectory(appRoamingDirectory);
            }

            this.config.appRoamingDirectory = appRoamingDirectory;

            this.config.configPath = Path.Combine(
                this.config.appRoamingDirectory,
                this.config.configFileName
            );

        }

        public void Load() {

            if (!File.Exists(this.config.configPath)) {
                return;
            }

            XmlReaderSettings xws = new XmlReaderSettings
            {
                CheckCharacters = false
            };

            // load config file
            string xml = File.ReadAllText(this.config.configPath);

            try
            {
                using (XmlReader xr = XmlReader.Create(new StringReader(xml), xws))
                {

                    XElement root = XElement.Load(xr);
                    foreach (XElement element in root.Elements())
                    {
                        if (element.HasElements)
                        {

                            if (element.Name.ToString() == "commands") 
                            {
                                this.LoadInnerXmlCommands(element);
                            }
                        }
                    }
                }
            }
            catch (Exception ex)
            {
                this.log.write(ex.Message);
            }
        }

        public void LoadInnerXmlCommands(XElement commandsElement)
        {
            foreach (XElement command in commandsElement.Descendants())
            {

                if (command.Name.ToString() == "command")
                {
                    //Command c = new Command();

                    foreach (XElement el in command.Descendants())
                    {
                        try
                        {

                            if (el.Name.ToString() == "name")
                            {
                                //c.name = el.Value;
                            }

                            if (el.Name.ToString() == "type")
                            {
                               // c.type = el.Value;
                            }

                            if (el.Name.ToString() == "priority")
                            {
                               // c.priority = Int64.Parse(el.Value);
                            }

                            if (el.Name.ToString() == "path")
                            {
                               // c.path = el.Value;
                            }

                            if (el.Name.ToString() == "extensions")
                            {
                               // c.extensions = el.Value;
                            }

                            if (el.Name.ToString() == "keywords")
                            {
                               // c.keywords = el.Value;
                            }

                            if (el.Name.ToString() == "action")
                            {
                                //c.action = el.Value;
                            }

                        }
                        catch (Exception ex)
                        {
                            this.log.write(ex.Message);
                        }
                    }

                    //commands.Add(c);
                }
            }
        }


        public void Save()
        {
            StringBuilder sb = new StringBuilder();
            XmlWriterSettings xws = new XmlWriterSettings
            {
                OmitXmlDeclaration = true,
                CheckCharacters = false,
                Indent = true
            };


            XElement root = new XElement("config");

            XElement items = new XElement("commands");

            XElement item = new XElement("command");
            item.Add(new XElement("name", ""));
            item.Add(new XElement("type", ""));
            item.Add(new XElement("priority", ""));
            item.Add(new XElement("path", ""));
            item.Add(new XElement("extensions", ""));
            items.Add(item);

            root.Add(items);

            try
            {

                using (XmlWriter xw = XmlWriter.Create(sb, xws))
                {
                    root.WriteTo(xw);
                }

            }
            catch (Exception ex)
            {
               this.log.write(ex.Message);
            }


            try
            {
                System.IO.StreamWriter file = new System.IO.StreamWriter(this.config.configPath);
                file.Write(sb.ToString());
                file.Close();

            }
            catch (System.IO.IOException ex)
            {
                this.log.write(ex.Message);
            }
            catch (Exception ex)
            {
                this.log.write(ex.Message);
            }

        }

    }
}
