using System;
using System.Collections.Generic;
using System.Text;

namespace Snippets.ClassNamespace
{
    class BaseClass
    {
        protected int c = 0;
    }


    class Class1 : BaseClass
    {

        public int a = 0;
        private int b = 0;

        public Class1()
        {
            Console.WriteLine("Constructor");
        }

        public void method1()
        {
            
            Console.WriteLine("method1");

            this.method2();
            method2();
        }

        public int method2()
        {
            Console.WriteLine("method2");
            return 2;
        }

        ~Class1()
        {
            Console.WriteLine("Destructor");
        }
    }

    class App
    {

        public static void Run()
        {
            Console.WriteLine("-Class");

            ClassNamespace.Class1 obj = new ClassNamespace.Class1();
            obj.method1();
        }
    }
}