# lilypond-api
REST API (Docker, PHP, Slim, Lilypond) for converting Lilypond file format to PDF and MIDI

## Prerequisite
- Install [composer](https://getcomposer.org/) 
- Install [docker](https://www.docker.com/)

## Start

#### Installation
```bash
composer install
```
	
#### Build
```bash
docker image build -t lilypond-api .
```

#### Run
```bash
docker run -p 80:80 lilypond-api
```

## API Usage

### Endpoint http://[docker-machine]/info

#### Request
- Verb : GET
- No parameter
	
#### Response
- Content-Type : Application/json
```json
{
  "apiName": "lilypond",
  "version": {
    "api": "1.1",
    "lilypond": "GNU LilyPond 2.18.2"
  },
  "description": "Lilypond to midi & pdf convertion"
}
```  
	
### Endpoint http://[docker-machine]/convert
	
#### Request	
- Verb : POST
- Content-Type : Application/json
- Parameters :
-- lpData : Lilypond format string 
```json
{
   "lpData": "\\score{ { c'4 d'4 e'4 f'4 } \\layout{} \\midi{} }"
}
```
	
#### Response
- Content-Type : Application/json
```json  
{
  "statusCode": "OK|ERROR",
  "message": "Information complement on error",
  "base64PdfData": "JVBERi0xLjQKJcfsj6IKNSAwIG9iago8PC9MZW5n.......0YK",
  "base64MidiData": "TVRoZAAAAAYAAQACAYBNVHJrAAAAUwD/Aw1jb250......F0b",
  "logs": [
    {
      "title": "Lilypond : PDF & MIDI Generation",
      "content": "Processing 5a9d77d267c75/5a9d77d267c75.lp"
    }
  ]
}
```

## Also read
- [How to contribute](CONTRIBUTING.md)
- [Code of conduct](CODE_OF_CONDUCT.md)
