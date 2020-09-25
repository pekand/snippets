using System;
using System.Collections.Generic;
using System.Text;

using Math2 = System.Math; // create alias
using static System.Math; // include static methods

namespace Snippets.UsingNamespace
{
    public class Disposable : IDisposable
    {

        private string resource = null;

        private bool disposed = false;

        public Disposable(string resource)
        {
            this.resource = resource;

            Console.WriteLine("Disposable: Constructor");
        }

        public void Dispose()
        {
            Console.WriteLine("Disposable: Dispose call");

            Dispose(true);
            GC.SuppressFinalize(this); // suppress destructor
        }

        protected virtual void Dispose(bool disposing)
        {
            Console.WriteLine("Disposable: Dispose virtual call: " + disposing.ToString());

            if (!this.disposed)
            {
                if (disposing)
                {
                    // Dispose managed resources.
                    Console.WriteLine("Disposable: Disposing managed resources");
                    // component.Dispose();
                }

                // clean up unmanaged resources here.
                Console.WriteLine("Disposable: Disposing unmanaged resources");
                this.resource = null;

                disposed = true;
            }
        }

        public void Action()
        {
            Console.WriteLine(this.resource);
        }

        ~Disposable()
        {
            Console.WriteLine("Disposable: Destructor");
            Dispose(false);
        }
    }

    class App
    {

        public static void Run()
        {
            Console.WriteLine("-Using statement");

            using (Disposable obj1 = new Disposable("res"), obj2 = new Disposable("res2"))
            {
                obj1.Action();
                obj2.Action();
            }

            // or 

            using Disposable obj3 = new Disposable("res3"), obj4 = new Disposable("res4");
            obj3.Action();
            obj4.Action();

            Console.WriteLine(Math2.Sqrt(2)); // using Math2 = System.Math;
            Console.WriteLine(Sqrt(2)); // using static System.Math;
        }
    }
}
