using System;
using System.Collections.Generic;
using System.Text;

namespace Snippets.StaticClassNamespace
{
    class Class1
    {
        public static int attrib1 = 0;

        public static void Method1()
        {
            Console.WriteLine(attrib1);
            Console.WriteLine(Class1.attrib1);
        }
    }

    class App
    {

        public static void Run()
        {
            Console.WriteLine("-static class");
            Class1.Method1();
        }
    }
}