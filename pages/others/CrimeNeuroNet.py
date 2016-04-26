import neurolab as nl
import numpy as np
import matplotlib.pyplot as plt
import math
from sklearn import preprocessing
import sys


class CrimeNeuroNet(object):
    def __init__(self):
        self.input_data, self.target_data = self.read_data("griddata.txt")
        self.inputs = len(self.input_data[0])
        self.outputs = len(self.target_data[0])

        self.do_train_test_network(self.input_data, self.target_data)   # type of learning to be used train_test splits dataset into 70%-30% for training-testing

    # this reads the data from "griddata.txt" you can change this to the file you've generated from the html code
    def read_data(self, filename):
        input_data = []
        target_data = []

        file = open(filename, "r") # grid data file generated from the html file.

        for line in file:
            line = line.split(" ")
            input_line = map(float, line[0].split(","))
            output_line = map(float, line[1].split(","))
            input_data.append(np.array(input_line))
            target_data.append(np.array(output_line[1:]))

        # input_data = np.array(input_data)
        # # target_data = np.array(target_data)

        # print input_data[0]

        # scaler = preprocessing.MinMaxScaler(feature_range=(-1, 1))
        # input_data = scaler.fit_transform(input_data)

        # print input_data[0]

        return (np.array(input_data), np.array(target_data))

    # initializes the input nodes for the neural network
    def init_input_nodes(self, inputs):
        inp_node = [np.min(inputs), np.max(inputs)]
        inp_nodes = []

        inp_node1 = [0, 1]
        inp_nodes.append(inp_node1)

        for x in range(0, len(inputs[0]) - 1):
            inp_nodes.append(inp_node)

        return inp_nodes


    # train_test network
    def do_train_test_network(self, input_data, target_data):
        inp_nodes = self.init_input_nodes(input_data)

        net = nl.net.newff(inp_nodes, [len(input_data[0]), len(target_data[0])])    # initializes the neural network values on the [] are the number of hidden neurons and number of output neurons

        # net.trainf = nl.train.train_gdm
        net.trainf = nl.train.train_rprop   # training function used for this experiment, you can change this to another, refer to the neurolab docs

        train_numbers = math.ceil(len(input_data) * 0.7)    # splits the dataset into 70% training and 70% test set
        test_numbers = math.floor(len(input_data) * 0.3)
        training_data_input = input_data[:int(train_numbers)]
        training_data_output = target_data[:int(train_numbers)]
        test_data_input = input_data[int(train_numbers):int(train_numbers) + int(test_numbers)]
        test_data_output = target_data[int(train_numbers):int(train_numbers) + int(test_numbers)]

        error = net.train(training_data_input, training_data_output, epochs=1000)   # training for the neural network

        # generates the SSE graph during training
        fig = plt.figure()
        train, = plt.plot(error)
        plt.legend([train], ['Train SSE'])
        plt.xlabel('Epochs')
        plt.ylabel('SSE')
        fig.savefig("trainingepochs.png")

        out = net.sim(input_data)   # activate/input the input_data to produce predictions of the trained model

        # out_test = net.sim(test_data_input)
        # self.get_accuracy(test_data_output, out_test)

        self.get_accuracy(target_data, out)     # computes for the accuracy, f1 score, etc of the trained model

        np.savetxt("predictionstest.txt", out, fmt='%.6f')  # saves a txt file containing the predictions, to be used in the html file

    # computes for accuracy and f1 score for the actual_data and predicted data
    def get_accuracy(self, actual_data, predict_data):

        print len(actual_data)
        print len(predict_data)

        accuracy = []
        f1scr = []

        for x, data in enumerate(actual_data):
            print len(data)
            print len(predict_data[x])
            correct = 0
            total = 0
            truepos = 0
            falsepos = 0
            trueneg = 0
            falseneg = 0

            for y, node in enumerate(data):
                total += 1
                if predict_data[x][y] >= 0.75:  # threshold for prediction. If prediction is greater than this value, prediction is one, zero otherwise
                    if node == 1:
                        correct += 1
                        truepos += 1
                    else:
                        falsepos += 1
                else:
                    if node == -1:
                        correct += 1
                        trueneg += 1
                    else:
                        falseneg += 1
            print "correct", correct
            print "total", total
            act = float(correct) / total
            print act
            accuracy.append(act)

            precision = truepos / float(truepos+falsepos)
            recall = truepos / float(truepos+falseneg)

            f1 = (precision * recall * 2) / float(precision + recall)

            f1scr.append(f1)

            print accuracy
            print f1

        print "Average Accuracy:", np.average(accuracy)
        print "Average F1 Score:", np.average(f1scr)

        # graph of Accuracy for each grid snapshot
        fig1 = plt.figure()
        plt.plot(accuracy)
        plt.xlabel('Week')
        plt.ylabel('Accuracy')
        fig1.savefig("Accuracy.png")
        # plt.show()

        # graph of F1 Score for each grid snapshot
        fig2 = plt.figure()
        plt.plot(f1scr)
        plt.xlabel('Week')
        plt.ylabel('F1 Score')
        fig2.savefig("F1Score.png")
        # plt.show()


class Logger(object):
    def __init__(self):
        self.terminal = sys.stdout
        self.log = open("mseout.txt", "a")

    def write(self, message):
        self.terminal.write(message)
        self.log.write(message)

sys.stdout = Logger()

run = CrimeNeuroNet()
