import base64
import codecs
import hashlib

MY_TRANSFORMATIONS = (
    ("MD5", "md5", lambda v, i, secs: hashlib.md5(v.encode()).hexdigest(),
    ("Reverse", "reverse", lambda v, i, secs: v[::-1],
    ("Base64 Encode", "base64_encode", lambda v, i, secs: base64.b64encode(v.encode()).decode(),
    ("Base64 Decode", "base64_decode", lambda v, i, secs: base64.b64decode(v.encode()).decode()
)