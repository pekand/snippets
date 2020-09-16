using System;

namespace Snippets.IsOperatorNamespace
{

    class App
    {

        public static void Run()
        {
            Console.WriteLine("-Is operator");

            ClassNamespace.Class1 d = new ClassNamespace.Class1();
            Console.WriteLine(d is ClassNamespace.BaseClass);
            Console.WriteLine(d is ClassNamespace.Class1);

            int value = 5;
            if (value is int a) // if value is int set a
            {
                Console.WriteLine(a + 5);  // output 30
            }
        }
    }
}
