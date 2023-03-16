import smbus
import smbus2
import bme280
import time
import datetime

# Définition de paramètres
I2C_ADDR  = 0x27 # Adresse I2C de l'écran
LCD_WIDTH = 16   # Caractère max par ligne

# Define some device constants
LCD_CHR = 1 # Mode - Envoi de données
LCD_CMD = 0 # Mode - Envoi de commande

LCD_LINE_1 = 0x80 # Adresse RAM de l'écran pour la première ligne
LCD_LINE_2 = 0xC0 # Adresse RAM de l'écran pour la deuxième ligne
# LCD_LINE_3 = 0x94 # Adresse RAM de l'écran pour la troisième ligne
# LCD_LINE_4 = 0xD4 # Adresse RAM de l'écran pour la quatrième ligne

LCD_BACKLIGHT  = 0x08  # On
#LCD_BACKLIGHT = 0x00  # Off

ENABLE = 0b00000100 # Enable bit

# Constantes de temps
E_PULSE = 0.0005
E_DELAY = 0.0005
DATA_DISPLAY_TIME = .75

############# Récupération des données du capteur #############
port = 1
address = 0x76
bus = smbus2.SMBus(port)

bme280.load_calibration_params(bus, address)
############# Récupération des données du capteur #############

#Ouverture de l'interface I2C
bus = smbus.SMBus(1)

def lcd_init():
  # Initialise display
  lcd_byte(0x33,LCD_CMD) # 110011 Initialisation
  lcd_byte(0x32,LCD_CMD) # 110010 Initialisation
  lcd_byte(0x06,LCD_CMD) # 000110 Cursor move direction
  lcd_byte(0x0C,LCD_CMD) # 001100 Allumage de l'écran,Curseur désactivé, Clignotement désactivé 
  lcd_byte(0x28,LCD_CMD) # 101000 Taille des données, nombre de lignes, taille de la police
  lcd_byte(0x01,LCD_CMD) # 000001 Nettoie l'écran
  time.sleep(E_DELAY)

def lcd_byte(bits, mode):
  # Envoie des données au broches
  # bits = la donnée
  # mode = 1 pour la donnée
  #        0 pour la commande

  bits_high = mode | (bits & 0xF0) | LCD_BACKLIGHT
  bits_low = mode | ((bits<<4) & 0xF0) | LCD_BACKLIGHT

  # High bits
  bus.write_byte(I2C_ADDR, bits_high)
  lcd_toggle_enable(bits_high)

  # Low bits
  bus.write_byte(I2C_ADDR, bits_low)
  lcd_toggle_enable(bits_low)

def lcd_toggle_enable(bits):
  # Toggle enable
  time.sleep(E_DELAY)
  bus.write_byte(I2C_ADDR, (bits | ENABLE))
  time.sleep(E_PULSE)
  bus.write_byte(I2C_ADDR,(bits & ~ENABLE))
  time.sleep(E_DELAY)

def lcd_string(message,line):
  # Send string to display

  message = message.ljust(LCD_WIDTH," ")

  lcd_byte(line, LCD_CMD)

  for i in range(LCD_WIDTH):
    lcd_byte(ord(message[i]),LCD_CHR)

def clear_screen():
  lcd_string("",LCD_LINE_1)
  lcd_string("",LCD_LINE_2)

def get_hour():
    # Obtenir l'heure actuelle
    now = datetime.datetime.now()
    return now.strftime("%H:%M")

def get_date():
    # Obtenir la date actuelle (AAAA-MM-JJ)
    today = datetime.date.today()

		######## JOUR ########  
		# Retourne le jour actuel en nombre (0 à 6)
    today_number = today.weekday()
    # Obtenir le jour de la semaine (0 = lundi, 6 = dimanche)
    week_day_array = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche']
    # Afficher le jour de la semaine
    today_day = week_day_array[today_number]

		######## MOIS ########
    # Obtenir le mois actuel (1 à 12)
    month = today.month
    # Afficher le mois
    month_array = ['', 'janvier', 'février', 'mars', 'avril', 'mai', 'juin','juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre']

    return "{} {} {}".format(today_day, today_number, month_array[month])
    

def main():
  # Bloc du programme principal

  # Initialise l'affichage
  lcd_init()

  while True:

		# Affichage de l'heure
    # lcd_string("{}".format(get_date().capitalize()),LCD_LINE_1)
    # lcd_string("     {}     ".format(get_hour()),LCD_LINE_2)
    # time.sleep(5)

    # Présentation de l'équipe
    lcd_string("Nicolas",LCD_LINE_1)
    time.sleep(.35)
    lcd_string("   Guillaume",LCD_LINE_2)
    time.sleep(.35)
    lcd_string("Nicolas    David",LCD_LINE_1)
    time.sleep(1.2)
    clear_screen()
    time.sleep(.75)
    ###############################
    lcd_string("   Guillaume",LCD_LINE_2)
    lcd_string("Nicolas    David",LCD_LINE_1)
    time.sleep(3)
    clear_screen()
    # Présentation de l'équipe

    data = bme280.sample(bus, address)

    # # Envoie du texte à l'écran
    # ########## TEMPERATURE ########## 
    lcd_string("  Temperature ",LCD_LINE_1)
    time.sleep(1)
    lcd_string("     {:.2f}C     ".format(data.temperature),LCD_LINE_2)
    time.sleep(1)
    lcd_string(">    {:.2f}C    <".format(data.temperature),LCD_LINE_2)
    time.sleep(DATA_DISPLAY_TIME)
    lcd_string(" >   {:.2f}C   < ".format(data.temperature),LCD_LINE_2)
    time.sleep(DATA_DISPLAY_TIME)
    lcd_string("  >  {:.2f}C  <  ".format(data.temperature),LCD_LINE_2)
    time.sleep(DATA_DISPLAY_TIME)
    lcd_string("   > {:.2f}C <   ".format(data.temperature),LCD_LINE_2)
    time.sleep(DATA_DISPLAY_TIME)
    lcd_string("    >{:.2f}C<    ".format(data.temperature),LCD_LINE_2)
    time.sleep(DATA_DISPLAY_TIME*2)
    clear_screen()

    ########## HUMIDITE ########## 
    lcd_string("    Humidite   ",LCD_LINE_1)
    time.sleep(1)
    lcd_string("     {:.2f}%     ".format(data.humidity),LCD_LINE_2)
    time.sleep(1)
    lcd_string(">    {:.2f}%    <".format(data.humidity),LCD_LINE_2)
    time.sleep(DATA_DISPLAY_TIME)
    lcd_string(" >   {:.2f}%   < ".format(data.humidity),LCD_LINE_2)
    time.sleep(DATA_DISPLAY_TIME)
    lcd_string("  >  {:.2f}%  <  ".format(data.humidity),LCD_LINE_2)
    time.sleep(DATA_DISPLAY_TIME)
    lcd_string("   > {:.2f}% <   ".format(data.humidity),LCD_LINE_2)
    time.sleep(DATA_DISPLAY_TIME)
    lcd_string("    >{:.2f}%<    ".format(data.humidity),LCD_LINE_2)
    time.sleep(DATA_DISPLAY_TIME*2)
    clear_screen()

    ########## PRESSION ########## 
    lcd_string("    Pression   ",LCD_LINE_1)
    time.sleep(1)
    lcd_string("    {:.1f}hPa    ".format(data.pressure),LCD_LINE_2)
    time.sleep(1)
    lcd_string(">   {:.1f}hPa   <".format(data.pressure),LCD_LINE_2)
    time.sleep(DATA_DISPLAY_TIME)
    lcd_string(" >  {:.1f}hPa  < ".format(data.pressure),LCD_LINE_2)
    time.sleep(DATA_DISPLAY_TIME)
    lcd_string("  > {:.1f}hPa <  ".format(data.pressure),LCD_LINE_2)
    time.sleep(DATA_DISPLAY_TIME)
    lcd_string("   >{:.1f}hPa<   ".format(data.pressure),LCD_LINE_2)
    time.sleep(2)
    clear_screen()
    time.sleep(2)

if __name__ == '__main__':

  try:
    main()
  except KeyboardInterrupt:
    pass
  finally:
    lcd_byte(0x01, LCD_CMD)

