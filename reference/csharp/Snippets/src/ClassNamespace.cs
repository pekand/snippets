using System;
using System.Collections.Generic;
using System.Text;

namespace Snippets.ClassNamespace
{
    interface IBase
    {
        string Name
        {
            get;
            set;
        }

        void Method1();
    }


    class BaseClass : IBase
    {
        protected int c = 0;
        internal int d = 0; // acess only from same asembly

        public string Name
        {
            get;
            set;
        }

        public void Method1() // interface implementation must by public
        {

            Console.WriteLine("method1");
        }

        protected virtual void F() {}
    }


    class Class1 : BaseClass
    {

        public int a = 0;
        private int b = 0;

        public Class1()
        {
            Console.WriteLine("Constructor");
        }

        public int Method2()
        {
            Console.WriteLine("method2");

            a = 1;
            b = 2;
            c = 3;

            Console.WriteLine("{0} {0} {0}", a, b, c);

            this.Method1();
            Method1();

            return 2;
        }

        ~Class1()
        {
            Console.WriteLine("Destructor");
        }
    }

    sealed class Class2 : BaseClass // mark class as final, prevent to extending class
    {
        sealed protected override void F() { } // prevent override this method by child
    }
    
    
    class App
    {
        private static void Action(IBase obj) {
            obj.Method1();
        }

        public static void Run()
        {
            Console.WriteLine("-Class");

            ClassNamespace.Class1 obj = new ClassNamespace.Class1();
            Action(obj);
            obj.Method2();
        }
    }
}