import requests
import json

def is_numeric(s):
    try:
        int(s)
        return True
    except ValueError:
        return False

def int_or_float(value):
    try:
        return int(value) if value is not None else None
    except ValueError:
        return float(value)

def num_to_alpha(num, length=0):
    res = ''

    if length:
        num = (num - 1) % (26 ** length) + 1

    while num > 0:
        num -= 1
        res = chr(97 + (num % 26)) + res  # ord("a") == 97
        num //= 26

    return res

def alpha_to_num(alpha):
    res = 0

    for c in alpha:
        res *= 26
        res += ord(c) - 96  # ord("a") == 97

    return res

def strip_line_spaces(string):
    return "\n".join([line.strip() for line in string.strip().split("\n")])

def post(data):
    r = requests.post('http://enjoy.test/sublime.php', data=json.dumps(data))

    return r.text
