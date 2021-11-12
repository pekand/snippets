using System;
using System.Diagnostics;


namespace ConsoleApp
{
    class Program
    {

        [DebuggerHidden]
        [Conditional("DEBUG")]
        static void  DebugBreak()
        {
            if (System.Diagnostics.Debugger.IsAttached)
                System.Diagnostics.Debugger.Break();
        }

        static void Main(string[] args)
        {
            UidGenerator generator = new UidGenerator();

            Stopwatch stopwatch = Stopwatch.StartNew();

            Console.WriteLine(generator.Generate());


            for (int i =0; i< 1000000;  i++ ) {
                DebugBreak();
                generator.Generate();
            }

            stopwatch.Stop();
            Console.WriteLine("time="+stopwatch.ElapsedMilliseconds.ToString());
        }
    }
}
