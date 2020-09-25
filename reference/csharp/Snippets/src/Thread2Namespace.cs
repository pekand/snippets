using System;
using System.Threading;

namespace Snippets.Thread2Namespace
{
    public class Worker
    {
        public void DoWork()
        {
            bool work = false;
            while (!_shouldStop)
            {
                work = !work; // simulate some work
            }
            Console.WriteLine("Worker thread: terminating gracefully.");
        }
        public void RequestStop()
        {
            _shouldStop = true;
        }

        private volatile bool _shouldStop; // shared between threads
    }

    class App
    {

        public static void Run()
        {
            Console.WriteLine("-Thread2");

            Worker workerObject = new Worker();
            Thread workerThread = new Thread(workerObject.DoWork);

            workerThread.Start();

            while (!workerThread.IsAlive)
                ;

            Thread.Sleep(500);

            workerObject.RequestStop();

            workerThread.Join();
            Console.WriteLine("Thread2: done");
        }
    }
}
