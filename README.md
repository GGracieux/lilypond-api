# lilypond-api
API REST conteneurisée (Docker, PHP, Slim, Lilypond) pour convertion de fichier LilyPond en PDF et MIDI

## Mise en route

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
Le serveur apache est exposé sur le port 80 avec deux EndPoint : 
- http://[docker-machine]/info 
- http://[docker-machine]/convert


## Utilisation

### API Endpoint /info

#### Request
- Methode : GET
- Pas de paramètres
	
#### Response
- Content-Type : Application/json
```json
{
   "apiName":"lilypond",
   "version":"1",
   "description":"Convertion de fichier lp en midi et pdf"
}
```  
	
### API Endpoint /convert
	
#### Request	
- Methode : POST
- Content-Type : Application/json
- Parametres :
-- lpData : Chaine au format Lilypond
```json
{"lpData": "\\score{ { c'4 d'4 e'4 f'4 } \\layout{} \\midi{} }"}
```
	
#### Response
- Content-Type : Application/json
```json  
{
  "statusCode": "OK|ERROR",
  "message": "Complement d'information en cas d'erreur",
  "base64PdfData": "JVBERi0xLjQKJcfsj6IKNSAwIG9iago8PC9MZW5n.......0YK",
  "base64MidiData": "TVRoZAAAAAYAAQACAYBNVHJrAAAAUwD/Aw1jb250......F0b",
  "logs": [
    {
      "title": "Lilypond : Generation PDF et Midi",
      "content": "Processing 5a9d77d267c75/5a9d77d267c75.lp"
    }
  ]
}
```
