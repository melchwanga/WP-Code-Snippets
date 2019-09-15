using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;
using MyLinkedList;

namespace MyConsoleApp
{
    class Program
    {
        static void Main(string[] args)
        {
            char[] Letters = { 'E', 'B', 'E', 'E', 'B', 'A', 'B' };
            int UserOption;
            Console.WriteLine("Please press 1 use custom list or any other key to use the default LinkedList");
            UserOption = Convert.ToInt32(Console.ReadLine());

            if(UserOption == 1)
            {
                Console.WriteLine("Please key in the linked list nodes, one after another. Each value being a character between A-Z");
                string InputLetters = Console.ReadLine();
              /*  if(Regex.IsMatch(InputLetters, @"^[a-zA-Z0-9]+$"))
                {
                    Console.WriteLine("String is valid");
                }*/
                while(!Regex.IsMatch(InputLetters, @"^[a-zA-Z]+$"))
                {
                    Console.WriteLine("Invalid input detected, only letters with no spaces are accepted.");
                    Console.WriteLine("Please key in the right input and hit Enter...");
                    InputLetters = Console.ReadLine();
                }
                Letters = InputLetters.ToCharArray();

            }            

            LinkedList<char> MyList = new LinkedList<char>(Letters);

            LinkedList<char> MyNewList = new LinkedList<char>();            

            MyLinkedList.LinkedListHelpers.TestNodeCount(MyList, "Original LinkedList");

            MyNewList = MyLinkedList.LinkedListHelpers.RefineDuplicates(MyList);

            MyLinkedList.LinkedListHelpers.TestNodeCount(MyNewList, "Refined LinkedList");

            Console.ReadLine();
        }
    }
}
