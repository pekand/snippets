using System;
using System.Collections.Generic;
using System.Text;

namespace Snippets.BaseClassNamespace
{
    public class Class1
    {

        public virtual void GetInfo()
        {
            Console.WriteLine("class1");
        }
    }
    class Class2 : Class1
    {
        public Class2(int i, int j) {
            Console.WriteLine("{0} {0}", i, j);
        }

        public override void GetInfo()
        {
            Console.WriteLine("class2");
        }
    }
    class Class3 : Class2
    {
        public Class3(int i): base(i, i) // call base clas constructor
        {
            Console.WriteLine(i);
        }

        public override void GetInfo()
        {
            Console.WriteLine("class3");
            base.GetInfo(); // call parent function
        }
    }

    class App
    {

        public static void Run()
        {
            Console.WriteLine("\n====Base====\n");

            BaseClassNamespace.Class3 obj = new BaseClassNamespace.Class3(1);
            obj.GetInfo();
        }
    }
}
