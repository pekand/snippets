using System;

namespace Snippets.SwitchNamespace
{


    class App
    {

        public static void Run()
        {
            Console.WriteLine("-SWITCH");

            int caseSwitch = 1;
            switch (caseSwitch)
            {
                case 1:
                    Console.WriteLine("Message");
                    goto case 2; // ????
                case 2:
                case 3:
                    Console.WriteLine("Message");
                    goto case 4;
                case 4:
                    Console.WriteLine("Message");
                    break;
                default:
                    Console.WriteLine("Message");
                    break;
            }
        }
    }
}
