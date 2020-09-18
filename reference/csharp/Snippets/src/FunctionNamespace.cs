using System;
using System.Collections.Generic;
using System.Text;

namespace Snippets.FunctionNamespace
{
    class App
    {
        public static void Run()
        {
            Console.WriteLine("-function");

            Console.WriteLine("-Function");

            ClassNamespace.Class1 obj = new ClassNamespace.Class1();
            obj.Method1();
            obj.Method2();
        }
    }
}
