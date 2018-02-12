import serial
import time

#Serial SETUP
ser = serial.Serial(port='/dev/ttyS1', baudrate=115200, timeout=0)
ser.write("import pyb\r\n")
ser.write("from pyb import Pin\r\n")
ser.write("REL1 = Pin('REL1', Pin.OUT_PP)\r\n")
ser.write("REL2 = Pin('REL2', Pin.OUT_PP)\r\n")

#ON_REL
ser.write("REL1.high()\r\n")
time.sleep(2)
ser.write("REL1.low()\r\n")
