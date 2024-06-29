using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Reflection;
using System.Windows.Forms;
using System.Xml.Linq;
using XmlConfig;

namespace XmlConfig
{
    /// <summary>
    /// load plugins</summary>
    public class Plugins //UID8736657869
    {
        public ICollection<IXmlConfigPlugin> plugins = new List<IXmlConfigPlugin>();

        Config config = null;
        Log log = null;

        public Plugins(Config config, Log log)
        {
            this.config = config;
            this.log = log;
        }

        /// <summary>
        /// load plugins from path</summary>
        public void LoadPlugins(string path)
        {
            try
            {
                this.log.write("Loading plugins from:" + path);

                IEnumerable<string> dllFileNames = null;
                if (Directory.Exists(path))
                {
                    dllFileNames = Directory.EnumerateFiles(path, "*.dll", SearchOption.AllDirectories);
                }

                ICollection<Assembly> assemblies = new List<Assembly>(dllFileNames.Count());
                foreach (string dllFile in dllFileNames)
                {
                    try
                    {
                        AssemblyName an = AssemblyName.GetAssemblyName(dllFile);
                        Assembly assembly = Assembly.Load(an);
                        if (assembly != null)
                        {
                            assemblies.Add(assembly);
                        }
                    }
                    catch (Exception e)
                    {
                        this.log.write("Load plugin error: " + dllFile + "  : " + e.Message);
                    }
                }

                // proces all assemblies in folder
                foreach (Assembly assembly in assemblies)
                {
                    Type[] types;

                    try
                    {
                        types = assembly.GetTypes();
                    }
                    catch (ReflectionTypeLoadException ex)
                    {
                        this.log.write("Load types from " + assembly.FullName + ": location:" + assembly.Location + "plugin error  : " + ex.Message);

                        foreach (var item in ex.LoaderExceptions)
                        {
                            this.log.write("Loaderexceptoon: " + item.Message);
                        }

                        this.log.write("Skipping plugin due to errors");
                        continue;
                    }

                    // proces all elements like classes in assemblie
                    foreach (Type type in types)
                    {
                        if (type.IsInterface || type.IsAbstract)
                        {
                            continue;
                        }

                        // get all libraries with IDiagramPlugin interface
                        if (type.GetInterface(typeof(IXmlConfigPlugin).FullName) == null)
                        {
                            continue;
                        }

                        // create plugin instance
                        if (!(Activator.CreateInstance(type) is IXmlConfigPlugin plugin))
                        {
                            continue;
                        }

                        // original assembly location for mapping resources
                        plugin.SetLocation(assembly.Location);

                        // add log object to plugin and allow debug messages from plugin
                        plugin.SetLog(this.log);

                        // assign plugin to collection of all plugins
                        plugins.Add(plugin);

                        this.log.write("Loading plugin: " + plugin.Name);

                        // add plugin to category

                        
                    }
                }
            }
            catch (Exception e)
            {
                this.log.write("Load plugin error : " + e.Message);
            }
        }

        /// <summary>
        /// run event for all registred plugins in NodeOpenPlugins </summary>
        public bool PluginAction()
        {

            bool stopNextAction = false;

            if (plugins.Count == 0)
            {
                return stopNextAction;
            }

            foreach (IXmlConfigPlugin plugin in plugins)
            {
                try
                {
                    stopNextAction = plugin.PluginAction();
                    if (stopNextAction)
                    {
                        break;
                    }
                }
                catch (Exception e)
                {
                    this.log.write("Exception in plugin: " + plugin.Name + " : " + e.Message);
                }
            }

            return stopNextAction;
        }

        
    }
}
