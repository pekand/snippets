﻿using System;

namespace Snippets.PropertiesNamespace
{

    class Person
    {
        private string name;

        public string Name   // property
        {
            get { return name; }   // get method
            set { name = value; }  // set method
        }

        public string Surname  // Automatic Properties
        { get; set; }
    }

    class App
    {

        public static void Run()
        {
            Console.WriteLine("-Properties");

            Person obj = new Person
            {
                Name = "Joe",
                Surname = "Smith"
            };

            Console.WriteLine(obj.Name);

        }
    }
}
