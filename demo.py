from docx2pdf import convert
from pdf2docx import Converter
import sys
import os
from PIL import Image
from fpdf import FPDF

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

if sys.argv[1] == 'i-b':
    filename = sys.argv[2]
    img = Image.open(filename).save(sys.argv[3])
    print("success")
    
if sys.argv[1] == 't-p':
    filename = sys.argv[2]
    pdf = FPDF()
    pdf.add_page()
    pdf.set_font("Arial",size = 14)
    f = open(filename,"r")
    for x in f:
        pdf.cell(200,10,txt = x,ln = 1,align = 'C')
        
    pdf.output(sys.argv[3])
    print("success")