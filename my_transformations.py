import base64
import codecs
import hashlib

MY_TRANSFORMATIONS = (
    ("MD5", "md5", lambda text: hashlib.md5(text.encode()).hexdigest()),
    ("Reverse", "reverse", lambda text: text[::-1]),
    ("Base64 Encode", "base64_encode", lambda text: base64.b64encode(text.encode()).decode()),
    ("Base64 Decode", "base64_decode", lambda text: base64.b64decode(text.encode()).decode())
)