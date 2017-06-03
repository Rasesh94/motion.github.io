import java.io.*;
import java.util.*;

public class Task4
{
    public static void main(String[] args)
            throws IOException,ClassNotFoundException
    {
        String surname;
        int mark;
        Result resultRec;
        Scanner keyboard = new Scanner(System.in);
        ObjectOutputStream outFile;
        ObjectInputStream inFile;

        outFile = new ObjectOutputStream (
                    new FileOutputStream("ResultObjects.dat"));



/**************************************************************

INSERT CODE FOR THE FOLLOWING:

(i)     ACCEPTING EACH SURNAME & MARK FROM THE STANDARD INPUT
        STREAM (VIA OBJECT 'keyboard' ABOVE);
        
        
(ii)    CREATING AN OBJECT OF CLASS Result FOR EACH NAME
        AND MARK ENTERED (USING REFERENCE resultRec ABOVE)
        AND WRITING THAT OBJECT TO STREAM outFile.

INSERT FURTHER CODE FOR THE FOLLOWING:

(iii)   READING THE OBJECTS BACK FROM THE FILE, USING THE
        METHODS OF CLASS Result TO RETRIEVE AND DISPLAY EACH
        NAME AND MARK AS THEY ARE READ IN.

**************************************************************/

}
    
}


