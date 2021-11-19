using System;
using System.Collections.Generic;
using System.Globalization;
using System.IO;
using System.Text;
using System.Xml;
using System.Xml.Linq;

namespace ConsoleApp1
{
    class ClassXml
    {

        public static string GetFileContent(string file)
        {
            try
            {
                using (StreamReader streamReader = new StreamReader(file, Encoding.UTF8))
                {
                    return streamReader.ReadToEnd();
                }
            }
            catch (System.IO.IOException ex)
            {

            }

            return null;
        }

        public static void ReadFile(string path, ClassData data) 
        {
            try
            {
                if (File.Exists(path))
                {

                    string xml = GetFileContent(path);

                    XmlReaderSettings xws = new XmlReaderSettings
                    {
                        CheckCharacters = false
                    };


                    using (XmlReader xr = XmlReader.Create(new StringReader(xml), xws))
                    {
                        XElement root = XElement.Load(xr);

                        LoadParams(root, data);
                    }

                }

            }
            catch (Exception ex)
            {

            }
        }

        public static void SavedFile(string path, ClassData data)
        {
            try
            {
                XElement root = SaveParams(data);

                System.IO.StreamWriter file = new System.IO.StreamWriter(path);

                string xml = "";

                StringBuilder sb = new StringBuilder();
                XmlWriterSettings xws = new XmlWriterSettings
                {
                    OmitXmlDeclaration = true,
                    CheckCharacters = false,
                    Indent = true
                };

                using (XmlWriter xw = XmlWriter.Create(sb, xws))
                {
                    root.WriteTo(xw);
                }

                xml = sb.ToString();

                file.Write(xml);
                file.Close();
            }
            catch (Exception ex)
            {

            }
        }

        public static void LoadParams(XElement root, ClassData data)
        {

            foreach (XElement element in root.Elements())
            {
                if (element.Name.ToString() == "value1")
                {
                    data.value1 = element.Value;
                }

                if (element.Name.ToString() == "value2")
                {
                    data.value2 = Int32.Parse(element.Value);
                }

                if (element.Name.ToString() == "value3")
                {
                    data.value3 = (float)Convert.ToDouble(element.Value);
                }

                if (element.Name.ToString() == "value4")
                {
                    data.value4 = element.Value == "1";
                }

                if (element.Name.ToString() == "options")
                {
                    
                    foreach (XElement optionElement in element.Elements())
                    {
                        ClassOption option = new ClassOption();

                        foreach (XElement optionValues in optionElement.Elements())
                        {

                            if (optionValues.Name.ToString() == "value1")
                            {
                                option.value1 = optionValues.Value;
                            }

                            if (optionValues.Name.ToString() == "value2")
                            {
                                option.value2 = optionValues.Value;
                            }
                        }

                        data.options.Add(option);
                    }
                }

            }
        }

        public static XElement SaveParams(ClassData data)
        {
            XElement root = new XElement("root");

            root.Add(new XElement("value1", data.value1));
            root.Add(new XElement("value2", data.value2.ToString()));
            root.Add(new XElement("value2", data.value3.ToString()));
            root.Add(new XElement("value2", data.value4 ? "1" : "0"));

            XElement options = new XElement("options");

            foreach (ClassOption option in data.options)
            {
                XElement optionElement = new XElement("option");
                optionElement.Add(new XElement("value1", option.value1));
                optionElement.Add(new XElement("value2", option.value2));
                options.Add(optionElement);
            }

            root.Add(options);

            return root;
        }

    }
}
