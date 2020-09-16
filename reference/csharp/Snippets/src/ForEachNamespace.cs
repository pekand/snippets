using System;
using System.Collections.Generic;

namespace Snippets.ForEachNamespace
{


    class App
    {

        public static void Run()
        {
            Console.WriteLine("-FOREACH");

            var list = new List<int> { 0, 1, 2, 3, 4 };
            foreach (int el in list)
            {
                Console.WriteLine($"Element: {el}");
            }
        }
    }
}
