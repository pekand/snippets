using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace XmlConfig
{
    public interface IXmlConfigPlugin
    {
        // name for identification plugin
        string Name { get; }

        // plugin version
        string Version { get; }

        // plugin location for resource mapping
        void SetLocation(string location);


        // connection to program debug console
        void SetLog(Log log);

        bool PluginAction();
    }
}
