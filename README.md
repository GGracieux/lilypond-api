# lilypond-api
REST API (Docker, PHP, Slim, Lilypond) for converting Lilypond file format to PDF and MIDI

## Start

#### Installation
```bash
cd api
composer install
```
	
#### Build
```bash
docker image build -t lilypond .
```

#### Run
```bash
docker-compose up
```
Apache server is listening on port 80 with two endpoints : 
- http://[docker-machine]/info 
- http://[docker-machine]/convert


## API Usage

### Endpoint /info

#### Request
- Verb : GET
- No parameter
	
#### Response
- Content-Type : Application/json
```json
{
   "apiName":"lilypond",
   "version":"1",
   "description":"Convereting lp file to midi and pdf"
}
```  
	
### Endpoint /convert
	
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
      "title": "Lilypond : PDF and MIDI Generation",
      "content": "Processing 5a9d77d267c75/5a9d77d267c75.lp"
    }
  ]
}
```

## Also read
- [How to contribute](CONTRIBUTING.md)
- [Code of conduct](CODE_OF_CONDUCT.md)
