using System;

namespace Snippets.DoWhileNamespace
{


    class App
    {

        public static void Run()
        {
            Console.WriteLine("-DO WHILE");

            int i1 = 0;
            do
            {
                Console.WriteLine(i1);
                i1++;
            } while (i1 < 5);
        }
    }
}
