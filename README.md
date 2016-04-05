<<<<<<< HEAD
# CCPO Crime Prediction and Reporting
## Getting Started

Steps on using the tool:
1. Choose which grid snapshot to use.   grid.html for monthly snapshots   gridweekly.html for weekly snapshots   griddaily.html for daily snapshots 
2. To change the grid size, find the variable “grid_size” in the html file and change its value (in meters). Then save the file. 
3. Open the edited html file in a browser of your choice. 
4. Click on the first "Choose Files" button to load your data. The data must be in a specific format. Check data Data.xlsx for the format and save the data as a .csv file 
5.  (Optional) To merge squares in the grid, press the "Merge Squares" button. Then click again the choose files button then press cancel. This will clear the previous loaded data. Then do step 4 again. Proceed to step 6 afterwards 
6. To generate the tile files for the neural network, press on the "Generate Tile Files" button. A file will be downloaded containing the data for the grid snapshots. 
7. Create a new folder and label it as desired. Place the downloaded file and the "CrimeNeuroNet.py" file to the same folder. 
8. Edit the necessary sections of code in "CrimeNeuroNet.py" like epochs, training function, to conduct experiments. Run the python code and this will generate experiment reports, graphs, and "predictiontest" file. 
9. Go back to the opened html file and click the 2nd "Choose Files" button. Open the generated "predictiontest" file" 
10. Click on the "Show Prediction Comparisons" to show the actual data and predicted data. Traverse the data using the back and forward buttons. 