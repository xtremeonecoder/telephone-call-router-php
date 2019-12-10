# Telephone Call Router - PHP Application
A simple _**PHP Application**_ that can handle any number of price lists (_operators_) and then can calculate which operator that is cheapest for a certain number. 

## System Requirements

### Routing of Telephone Calls
Some telephone operators have submitted their price lists including price per minute for different phone number prefixes. The price lists look like this:

### Operator A:
1 --------- 0.9

268	----------- 5.1

46 ------------ 0.17

4620 ---------- 0.0

468 ----------- 0.15

4631 ---------- 0.15

4673 ---------- 0.9

46732 --------- 1.1

### Operator B:
1 ----------- 0.92

44 ---------- 0.5

46 ---------- 0.2

467 --------- 1.0

48 ---------- 1.2

And so on...

The left column represents the telephone prefix (_country + area code_) and the right column represents the operators price per minute for a number starting with that prefix. When several prefixes match the same number, the longest one should be used. If you, for example, dial +46-73-212345 you will have to pay $ 1.1/min with _Operator-A_ and $ 1.0/min with _Operator-B_. 

If a price list does not include a certain prefix you cannot use that operator to dial numbers starting with that prefix. For example it is not possible to dial +44 numbers with _Operator-A_ but it is possible with _Operator-B_.

### The Goal
The goal with this exercise is to write a program that can handle any number of price lists (_operators_) and then can calculate which operator that is cheapest for a certain number. You can assume that each price list can have thousands of entries but they will all fit together in memory.

Telephone numbers should be inputted in the same format as in price lists, for example “_68123456789_”. The challenge is to find the cheapest operator for that number.

### Instructions
●	_Use your favorite language to solve the exercise_

●	_Put your focus on code design and readability_ 

●	_Do not use a database or create a GUI_ 

●	_Plus is given to effective solutions_ 

●	_The code should have unit tests_

●	_Deliver to us via GIT repository_

## Solution Details
I developed this project with _**PHP**_ as per given instruction manual. Some necessary information given below -

### Programming Language: PHP

### PHP Version:
![PHP version used in the application](https://github.com/xtremeonecoder/telephone-call-router-php/blob/master/documentation/Programming-Environment.jpg)

### Used IDE
I have developed, executed and tested the project using _**NetBeans IDE 8.2**_. I would recommend the same environment for testing.

### Operating System: Ubuntu 18.04.1 LTS

### Project Directory Structure
**Root Directory – _programming-exercise_**
**Script File Path -**
_**programming-exercise => index.php**_

### Testing Instruction
Initially two operators (_Operator-A & Operator-B_) are given. If you want to test the script with more operators’ data (_Operator-C & Operator-D_), then please uncomment the following commented code lines of function: _**getTelephoneOperators()**_.

![Commented extra data for testing the application](https://github.com/xtremeonecoder/telephone-call-router-php/blob/master/documentation/Extra-Data-for-Testing.jpg)