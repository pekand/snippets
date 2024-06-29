using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace XmlConfig
{
    public class Config
    {

        public string logFile = "app.log";

#if DEBUG
       public bool isDebugMode = true;
       public string configFileName = "config.debug.xml";
#else
       public bool isDebugMode = false;
       public string configFileName = "config.xml"; 
#endif

        public string appName = "XmlConfig";
        public string appRoamingDirectory = "";
        public string configPath = "";

    }
}
