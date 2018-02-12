import socket
import os
import time
import serial
from crontab import CronTab

#Serial setup
ser = serial.Serial(port='/dev/ttyS1', baudrate=115200, timeout=0)

#Connect socket server
client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
client_socket.settimeout(None)
client_socket.setsockopt( socket.SOL_SOCKET, socket.SO_KEEPALIVE, 1)
client_socket.connect(('181.129.168.242', 7775))

#Setup crontab
cron = CronTab(user='root')

#Setup STM
ser.write("import pyb\r\n")
ser.write("from pyb import Pin\r\n")
ser.write("REL1 = Pin('REL1', Pin.OUT_PP)\r\n")
ser.write("REL2 = Pin('REL2', Pin.OUT_PP)\r\n")

while 1:
    data = client_socket.recv(512)
    if ( data == 'Command1\r\n'):
	#ON_REL
	ser.write("REL1.high()\r\n")
	time.sleep(2)
	ser.write("REL1.low()\r\n")
    elif ( data == 'Command2\r\n'):
	print "REL_OFF"
	ser.write("REL1.low()\r\n")
    elif ( 'time=' in data):
    	time,frec,grs = data.split(";")
	time = time.replace('time=','')
    	if (frec == 'frec=0'):
		job = cron.new(command='python ~/aquarium_files/Python_Mcmahon/feed.py', comment='E')
		job.every(24).hours()
		job.hour.also.on(time)  
		cron.write() 
	elif (frec == 'frec=1'):
		job = cron.new(command='python ~/aquarium_files/Python_Mcmahon/feed.py', comment='W')
                job.every(24).hours()
		job.hour.also.on(time)
		job.dow.on('FRI', 'SAT', 'SUN')
		cron.write()
	elif (frec == 'frec=2'):
		job = cron.new(command='python ~/aquarium_files/Python_Mcmahon/feed.py', comment='M')
		job.every(24).hours()
                job.hour.also.on(time)
                job.dow.on('MON', 'TUE', 'WED', 'THU', 'FRI')
		cron.write()
    if('cron=' in data):
	name = data.replace('cron=','')
	cron.remove_all()  

