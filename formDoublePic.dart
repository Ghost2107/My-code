class ClientRegistrationForm extends StatefulWidget {
  const ClientRegistrationForm({super.key});

  @override
  ClientRegistrationFormState createState() => ClientRegistrationFormState();
}

class ClientRegistrationFormState extends State<ClientRegistrationForm> {
  bool _isAppartementSelected = false;
  bool _isMaisonBasseSelected = false;

  late final TextEditingController _pieceController;
  late TextEditingController _phoneController;

  File? _pickedImageCNI; // Variable pour stocker l'image de la CNI
  File? _pickedImageFacture; // Variable pour stocker l'image de la facture

  final ImagePicker _imagePicker = ImagePicker();
  final List<File> _imageFileList = [];

  void _selectImages() async {
    final pickedImages = await _imagePicker.pickMultiImage(
      imageQuality: 100,
      maxHeight: 1000,
      maxWidth: 1000,
    );

    if (pickedImages != null && pickedImages.isNotEmpty) {
      setState(() {
        _imageFileList.addAll(pickedImages.map((image) => File(image.path)));
      });
    }
  }

  @override
  void initState() {
    _pieceController =
        TextEditingController(); // Initialisation de _pieceController
    _phoneController =
        TextEditingController(); // Initialisation de _phoneController
    super.initState();
  }

  Widget _buildImageGrid() {
    return Container(
      height: 250, // Définissez la hauteur souhaitée pour votre grille d'images
      child: Padding(
        padding: const EdgeInsets.all(8.0),
        child: GridView.builder(
          gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
            crossAxisCount: 3,
            mainAxisSpacing: 8.0, // Espace vertical entre les images
            crossAxisSpacing: 8.0, // Espace horizontal entre les images
          ),
          itemCount: _imageFileList.length,
          itemBuilder: (BuildContext context, int index) {
            String imageUrl = _imageFileList[index].path;
            return Container(
                child: Image.network(
              imageUrl,
              fit: BoxFit.cover,
            ));
          },
        ),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Formulaire D'inscription Client"),
      ),
      body: Center(
        child: SingleChildScrollView(
          reverse: true,
          padding: const EdgeInsets.all(32),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: <Widget>[
              const SizedBox(height: 20),
              TextFormField(
                decoration: const InputDecoration(labelText: 'Nom et Prénoms'),
                keyboardType: TextInputType.name,
                validator: (value) {
                  if (value?.isEmpty ?? true) {
                    return "S'il vous plaît entrez votre nom et prénoms";
                  }
                  return null;
                },
              ),
              TextFormField(
                decoration: const InputDecoration(labelText: 'Email'),
                keyboardType: TextInputType.emailAddress,
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return "S'il vous plaît entrez votre adresse email";
                  } else if (!EmailValidator.validate(value)) {
                    return "Veuillez entrer une adresse email valide";
                  }
                  return null;
                },
              ),
              TextFormField(
                decoration: const InputDecoration(labelText: 'Mot de passe'),
                obscureText: true,
                validator: (value) {
                  if (value?.isEmpty ?? true) {
                    return 'S\'il vous plaît, entrez un mot de passe';
                  }
                  // Ajouter la validation de la force du mot de passe
                  if (value!.length < 6) {
                    return 'Le mot de passe doit contenir au moins 6 caractères';
                  }
                  return null;
                },
              ),
              TextFormField(
                decoration:
                    const InputDecoration(labelText: 'Numéro de téléphone'),
                keyboardType: TextInputType.phone,
                inputFormatters: [
                  FilteringTextInputFormatter.digitsOnly,
                  LengthLimitingTextInputFormatter(10), // Limiter à 10 chiffres
                ],
                controller: _phoneController,
                validator: (value) {
                  if (value?.isEmpty ?? true) {
                    return "S'il vous plaît entrez votre numéro de téléphone";
                  } else if (value!.length != 10) {
                    return "Le numéro de téléphone doit comporter 10 chiffres";
                  }
                  return null;
                },
              ),
              const SizedBox(height: 20),
              TextFormField(
                decoration: const InputDecoration(labelText: 'Profession'),
                keyboardType: TextInputType.text,
                validator: (value) {
                  if (value?.isEmpty ?? true) {
                    return "S'il vous plait entrez votre profession";
                  }
                  return null;
                },
              ),
              const SizedBox(height: 20),
              DropdownButtonFormField<String>(
                decoration: const InputDecoration(labelText: 'Localité'),
                items: const [
                  DropdownMenuItem<String>(
                    value: 'Abidjan',
                    child: Text('Abidjan'),
                  ),
                  DropdownMenuItem<String>(
                    value: 'Yamoussoukro',
                    child: Text('Yamoussoukro'),
                  ),
                  DropdownMenuItem<String>(
                    value: 'Abengourou',
                    child: Text('Abengourou'),
                  ),
                  DropdownMenuItem<String>(
                    value: 'Bondoukoou',
                    child: Text('Bondoukoou'),
                  ),
                  DropdownMenuItem<String>(
                    value: 'Touba',
                    child: Text('Touba'),
                  ),
                  DropdownMenuItem<String>(
                    value: 'Danane',
                    child: Text('Danane'),
                  ),
                  DropdownMenuItem<String>(
                    value: 'Korhogo',
                    child: Text('Korhogo'),
                  ),
                  // Ajouter d'autres localités selon les besoins
                ],
                onChanged: (value) {
                  // Gérer la sélection de la localité
                },
              ),
              const SizedBox(height: 20),
              Row(
                children: [
                  Checkbox(
                    value: _isAppartementSelected,
                    onChanged: (value) {
                      setState(() {
                        _isAppartementSelected = value!;
                        if (value) {
                          _isMaisonBasseSelected = false;
                        }
                      });
                    },
                  ),
                  const Text('Appartement'),
                ],
              ),
              Row(
                children: [
                  Checkbox(
                    value: _isMaisonBasseSelected,
                    onChanged: (value) {
                      setState(() {
                        _isMaisonBasseSelected = value!;
                        if (value) {
                          _isAppartementSelected = false;
                        }
                      });
                    },
                  ),
                  const Text('Maison basse'),
                ],
              ),
              _buildImageGrid(),
              MaterialButton(
                color: Colors.amber,
                child: const Text("Choisir des photos"),
                onPressed: () {
                  _selectImages();
                },
              ),
              const SizedBox(height: 20),
              ElevatedButton(
                onPressed: () {
                  // Gérer la soumission du formulaire de fournisseur
                  // Implémenter la logique de soumission ici
                  _sendDataToAPI();
                },
                child: const Text('Envoyer'),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Future<void> _sendDataToAPI() async {
    if (_imageFileList.length < 2) {
      // Vérifier si les deux images ont été téléchargées
      showDialog(
        context: context,
        builder: (context) {
          return AlertDialog(
            title: const Text("Erreur"),
            content: const Text("Veuillez télécharger au moins deux images."),
            actions: <Widget>[
              TextButton(
                onPressed: () {
                  Navigator.of(context).pop();
                },
                child: const Text("OK"),
              ),
            ],
          );
        },
      );
    } else {
      // Envoyer les données à l'API
      // Exemple :
      // var nom = _nomController.text;
      // var email = _emailController.text;
      // var profession = _professionController.text;
      // var localite = _localiteValue;
      // var image1 = _pickedImage;
      // var image2 = _pickedImage2;
      // Ensuite, utilisez ces valeurs pour appeler l'API ou enregistrer dans une base de données
    }
  }

  @override
  void dispose() {
    _pieceController.dispose();
    super.dispose();
  }
}
