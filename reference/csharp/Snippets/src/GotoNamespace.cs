using System;

namespace Snippets.GotoNamespace
{


    class App
    {

        public static void Run()
        {
            Console.WriteLine("-GOTO");

            int value1 = 4;

            if (value1 == 4)
            {
                goto Found;
            }

        Found:
            Console.WriteLine("Message");
        }
    }
}
