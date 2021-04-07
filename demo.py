from docx2pdf import convert
from pdf2docx import Converter
import sys
import os
import win32com import client
from traceback import print_exc
from PIL import Image

if sys.argv[1] == 'd-p':
    convert(sys.argv[2])
    print("convert success")
    
if sys.argv[1] == 'p-d':
    cv = Converter(sys.argv[2])
    open(sys.argv[3],"a")
    cv.convert(sys.argv[3],start = 0, end = None)
    cv.close()
    print("convert success")

if sys.argv[1] == 'i-i':
    filename = sys.argv[2]
    img = Image.open(filename)
    img.save(sys.argv[3])
    print("success")
