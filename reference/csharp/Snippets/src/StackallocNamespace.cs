using System;

namespace Snippets.StackallocNamespace
{
    class App
    {

        public static void Run()
        {
            Console.WriteLine("\n====Stackalloc====\n");

            int length = 3;
            Span<int> numbers = stackalloc int[length]; //allocates a block of memory on the stack
            for (var i = 0; i < length; i++)
            {
                numbers[i] = i;
                Console.WriteLine(numbers[i]);
            }
        }
    }
}
