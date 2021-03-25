using System;
using System.Collections.Generic;
using System.Text;

namespace Snippets.VirtualNamespace
{

    class Shape
    {
        public virtual int GetArea() { // allow overide method by child when in called in context of perent
            return 1;
        }
    }

    class Square : Shape
    {

        public override int GetArea() // must have same access level
        {
            return 2;
        }
    }

    class App
    {

        public static void Run()
        {
            Console.WriteLine("\n====Virtual====\n");

            Shape shape1 = new Shape();
            int area1 = shape1.GetArea(); 
            Console.WriteLine("shape1 area = " + area1);

            Shape shape2 = new Square(); // child is used as perent
            int area2 = shape2.GetArea(); // call child method instead of parent method
            Console.WriteLine("shape2 area = " + area2);
            
        }
    }

}
