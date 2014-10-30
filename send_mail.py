import sys
import os
import smtplib
import email.Message
import socket

addr_to = sys.argv[1]

addr_from = "courier@students.iiit.ac.in"
server = smtplib.SMTP('students.iiit.ac.in')

Body_msg = sys.argv[2]

msg = ("From: %s\r\nSubject: You have received a Courier \r\nTo: %s\r\n\r\n"% (addr_from, addr_to))
msg = msg + Body_msg
server.sendmail(addr_from, addr_to, msg)
server.quit()
