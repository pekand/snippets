using System;

namespace Snippets.TryCatchNamespace
{


    class App
    {

        public static void Run()
        {
            Console.WriteLine("-TRY");

            try
            {
                try
                {
                    throw new DivideByZeroException();
                }
                catch (DivideByZeroException ex) when (ex.Message != "Attempted to divide by zero.") // filter exception
                {
                    Console.WriteLine("E1:" + ex.Message);
                }
                catch (ArithmeticException ex)
                {
                    Console.WriteLine("E2:" + ex.Message);
                    throw; // rethrow
                }
                catch (Exception ex)
                {
                    Console.WriteLine("E3:" + ex.Message);
                }
                finally
                {
                    Console.WriteLine("Done");
                }
            }
            catch (Exception ex)
            {
                Console.WriteLine("E4:" + ex.Message);
            }
        }
    }
}
