using System;

namespace Snippets.ForNamespace
{


    class App
    {

        public static void Run()
        {
            Console.WriteLine("-FOR");

            for (int i = 0; i < 5; i++)
            {
                if (i == 2)
                {
                    continue;
                }

                if (i == 4)
                {
                    break;
                }

                Console.WriteLine("Message");
            }

            for (; ; )
            {
                break;
            }
        }
    }
}
