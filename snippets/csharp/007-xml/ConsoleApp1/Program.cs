using System;
using System.IO;

namespace ConsoleApp1
{
    class Program
    {
        static void Main(string[] args)
        {
            ClassData data = new ClassData();

            if (File.Exists("file.xml"))
            {
                ClassXml.ReadFile("file.xml", data);
            }
            else {
                data.options.Add(new ClassOption());
                data.options.Add(new ClassOption());
            }

           

            Console.WriteLine("Hello World!");

            ClassXml.SavedFile("file.xml", data);
        }
    }
}
