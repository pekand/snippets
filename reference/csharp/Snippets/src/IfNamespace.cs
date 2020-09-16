using System;

namespace Snippets.IfNamespace
{


    class App
    {

        public static void Run()
        {
            Console.WriteLine("-IF");

            int value1 = 4;

            if (value1 == 1)
                Console.WriteLine("Message");

            if (value1 == 2)
            {
                Console.WriteLine("Message");
            }
            else if (value1 == 3)
            {
                Console.WriteLine("Message");
            }
            else
            {
                Console.WriteLine("Message");
            }
        }
    }
}
