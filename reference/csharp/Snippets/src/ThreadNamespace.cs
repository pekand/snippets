using System;
using System.Threading;

namespace Snippets.ThreadNamespace
{
    class App
    {

        static readonly object obj = new object();  
  
        static void TestLock()  
        {  
              
            lock (obj)  
            {  
                Thread.Sleep(100);  
                Console.WriteLine(Environment.TickCount);  
            }  
        }  

        public static void Run()
        {
            Console.WriteLine("-Thread");

            for (int i = 0; i < 10; i++)  
            {  
                ThreadStart start = new ThreadStart(TestLock);  
                new Thread(start).Start();  
            }  
        }
    }
}
