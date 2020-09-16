using System;
using System.Collections.Generic;
using System.Text;

namespace Snippets.NestedNamespace
{
    class Class1
    {

        public static void method1()
        {

        }
    }


    class Class2
    {
        public static void method1()
        {
            Class1.method1();
            NestedNamespace.Class1.method1();
        }

    }

    namespace NestedNamespace
    {
        public class Class1
        {
            public static void method1()
            {
                Console.WriteLine("Message");
            }
        }
    }

    class App
    {

        public static void Run()
        {
            Console.WriteLine("-nested namespace");
        }
    }
}